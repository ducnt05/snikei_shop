from playwright.sync_api import sync_playwright
import os
import re

BASE_URL = os.environ.get('BASE_URL', 'http://localhost/snikei_shop/public')
EMAIL = os.environ.get('LOGIN_EMAIL', 'admin@gmail.com')
PASSWORD = os.environ.get('LOGIN_PASSWORD', '123456')
OUT_DIR = os.path.join(os.path.dirname(__file__), '..', 'report_images')
PRODUCT_ID = os.environ.get('PRODUCT_ID', '23')

if not os.path.exists(OUT_DIR):
    os.makedirs(OUT_DIR, exist_ok=True)


def safe_text_price(text):
    if not text:
        return None
    # extract digits and decimals
    s = re.sub(r'[^\d\.]', '', text.replace(',', ''))
    try:
        return float(s)
    except Exception:
        return None

with sync_playwright() as p:
    browser = p.chromium.launch(headless=False)
    context = browser.new_context(viewport={"width": 1400, "height": 1000})
    page = context.new_page()

    # Login
    page.goto(BASE_URL + '/login', wait_until='networkidle')
    try:
        page.fill('input[name="email"]', EMAIL)
        page.fill('input[name="password"]', PASSWORD)
        page.click('button[type="submit"]')
    except Exception:
        pass
    page.wait_for_load_state('networkidle')

    # Go to product detail
    product_url = BASE_URL + f'/shop?id={PRODUCT_ID}'
    print('Opening product detail:', product_url)
    page.goto(product_url, wait_until='networkidle')
    page.wait_for_timeout(1500)

    # Try to click add-to-cart form/button
    added = False
    try:
        # look for form that posts to process_addcart
        forms = page.query_selector_all('form')
        for f in forms:
            action = f.get_attribute('action') or ''
            if 'process_addcart' in action:
                print('Submitting add-to-cart form with action', action)
                f.evaluate('(form)=>form.submit()')
                added = True
                break
        if not added:
            # try clicking any button with add-to-cart text
            buttons = page.query_selector_all('button')
            for b in buttons:
                txt = (b.inner_text() or '').lower()
                if 'add' in txt or 'cart' in txt or 'mua' in txt:
                    try:
                        b.click()
                        added = True
                        break
                    except Exception:
                        pass
    except Exception as e:
        print('Error trying to add to cart:', e)

    page.wait_for_timeout(1500)

    # Capture product detail full page and a cropped element (if possible)
    pd_out = os.path.join(OUT_DIR, 'product_detail.png')
    page.screenshot(path=pd_out, full_page=True)
    print('Saved product detail full:', pd_out)

    # Attempt to capture product detail container
    try:
        sel = page.query_selector('[data-product-detail], .product-detail, #product')
        if sel:
            sel.screenshot(path=os.path.join(OUT_DIR, 'product_detail_element.png'))
            print('Saved product detail element')
    except Exception:
        pass

    # Now prepare checkout: read price from page if available
    total_price = None
    try:
        # common selectors for price
        candidates = [
            '.price', '.product-price', '.amount', 'span.price', 'p.price', '.product-price span'
        ]
        for c in candidates:
            e = page.query_selector(c)
            if e:
                txt = e.inner_text()
                val = safe_text_price(txt)
                if val:
                    total_price = val
                    break
    except Exception:
        pass

    if total_price is None:
        total_price = 100000.0

    print('Using total_price:', total_price)

    # POST to /checkout to set session payment_qr
    try:
        checkout_endpoint = BASE_URL + '/checkout'
        print('Posting to checkout to set session')
        page.evaluate("(url, price)=>{fetch(url,{method:'POST',headers:{'Content-Type':'application/x-www-form-urlencoded'},body:'total_price='+encodeURIComponent(price)}).then(r=>r.text()).catch(e=>console.log(e));}", checkout_endpoint, str(total_price))
        page.wait_for_timeout(1000)
    except Exception as e:
        print('Checkout POST failed:', e)

    # Open checkout QR page
    qr_url = BASE_URL + '/checkout/qr'
    print('Opening checkout QR page:', qr_url)
    page.goto(qr_url, wait_until='networkidle')
    page.wait_for_timeout(1500)

    co_out = os.path.join(OUT_DIR, 'checkout.png')
    page.screenshot(path=co_out, full_page=True)
    print('Saved checkout full:', co_out)

    # Close
    browser.close()

print('Done')
