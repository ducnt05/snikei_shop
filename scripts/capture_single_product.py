from playwright.sync_api import sync_playwright
import os

BASE_URL = os.environ.get('BASE_URL', 'http://localhost/snikei_shop/public')
EMAIL = os.environ.get('LOGIN_EMAIL', 'admin@gmail.com')
PASSWORD = os.environ.get('LOGIN_PASSWORD', '123456')
OUT_DIR = os.path.join(os.path.dirname(__file__), '..', 'report_images')
PRODUCT_ID = os.environ.get('PRODUCT_ID', '23')

if not os.path.exists(OUT_DIR):
    os.makedirs(OUT_DIR, exist_ok=True)

with sync_playwright() as p:
    browser = p.chromium.launch(headless=False)
    context = browser.new_context(viewport={"width": 1400, "height": 900})
    page = context.new_page()

    # login
    page.goto(BASE_URL + '/login')
    try:
        page.fill('input[name="email"]', EMAIL)
        page.fill('input[name="password"]', PASSWORD)
        page.click('button[type="submit"]')
    except Exception:
        pass

    page.wait_for_load_state('networkidle')

    url = BASE_URL + f'/shop?id={PRODUCT_ID}'
    print('Capturing', url)
    page.goto(url)
    page.wait_for_load_state('networkidle')
    out = os.path.join(OUT_DIR, 'product_detail.png')
    page.screenshot(path=out, full_page=True)
    print('Saved', out)

    browser.close()
