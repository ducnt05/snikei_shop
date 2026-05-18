from playwright.sync_api import sync_playwright
import os
import time

BASE_URL = os.environ.get('BASE_URL', 'http://localhost/snikei_shop/public')
EMAIL = os.environ.get('LOGIN_EMAIL', 'admin@gmail.com')
PASSWORD = os.environ.get('LOGIN_PASSWORD', '123456')
OUT_DIR = os.path.join(os.path.dirname(__file__), '..', 'report_images')
PRODUCT_ID = os.environ.get('PRODUCT_ID', '23')

if not os.path.exists(OUT_DIR):
    os.makedirs(OUT_DIR, exist_ok=True)

with sync_playwright() as p:
    browser = p.chromium.launch(headless=False)
    context = browser.new_context(viewport={"width": 1400, "height": 1000})
    page = context.new_page()

    # login
    page.goto(BASE_URL + '/login', wait_until='networkidle')
    try:
        page.fill('input[name="email"]', EMAIL)
        page.fill('input[name="password"]', PASSWORD)
        page.click('button[type="submit"]')
    except Exception:
        pass
    page.wait_for_load_state('networkidle')
    time.sleep(1)

    # product detail
    product_url = BASE_URL + f'/shop?id={PRODUCT_ID}'
    page.goto(product_url, wait_until='networkidle')
    # wait for main image to load
    try:
        img = page.wait_for_selector('.product-left img', timeout=5000)
        # wait until naturalWidth > 0
        for _ in range(10):
            natural = page.evaluate('(img)=>img.naturalWidth', img)
            if natural and int(natural) > 20:
                break
            time.sleep(0.5)
    except Exception:
        pass
    page.wait_for_timeout(1000)
    pd_out = os.path.join(OUT_DIR, 'product_detail.png')
    page.screenshot(path=pd_out, full_page=True)
    print('Saved', pd_out)

    # submit add-to-cart form on product detail
    try:
        form = page.query_selector('form[action*="process_addcart"]')
        if form:
            form.evaluate('(f)=>f.submit()')
            print('Submitted add-to-cart form')
            page.wait_for_load_state('networkidle')
            page.wait_for_timeout(1000)
    except Exception as e:
        print('Error submitting add-to-cart form:', e)

    # go to shop and ensure cart has items
    page.goto(BASE_URL + '/shop', wait_until='networkidle')
    page.wait_for_timeout(1000)
    # check for cart items
    try:
        cart_item = page.query_selector('.cart-product-item')
        if cart_item:
            print('Cart has items')
        else:
            print('Cart seems empty')
    except Exception:
        pass

    # try to read total_price from cart checkout form
    total_price = None
    try:
        el = page.query_selector('form[action*="/checkout"] input[name="total_price"]')
        if el:
            total_price = page.evaluate('(e)=>e.value', el)
    except Exception:
        pass

    if not total_price:
        total_price = '100000'

    # perform checkout POST via fetch to set session.payment_qr
    try:
        # Use a single object argument to avoid evaluate argument errors
        payload = { 'url': BASE_URL + '/checkout', 'price': total_price }
        page.evaluate("(obj)=>{return fetch(obj.url,{method:'POST',headers:{'Content-Type':'application/x-www-form-urlencoded'},body:'total_price='+encodeURIComponent(obj.price)}).then(r=>r.text())}", payload)
        page.wait_for_timeout(1000)
    except Exception as e:
        print('Checkout POST failed:', e)

    # open checkout/qr
    page.goto(BASE_URL + '/checkout/qr', wait_until='networkidle')
    page.wait_for_timeout(1500)
    co_out = os.path.join(OUT_DIR, 'checkout.png')
    page.screenshot(path=co_out, full_page=True)
    print('Saved', co_out)

    browser.close()
print('Done')
