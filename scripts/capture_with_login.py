from playwright.sync_api import sync_playwright
import os
import sys

BASE_URL = os.environ.get('BASE_URL', 'http://localhost/snikei_shop/public')
EMAIL = os.environ.get('LOGIN_EMAIL', 'admin@gmail.com')
PASSWORD = os.environ.get('LOGIN_PASSWORD', '123456')
OUT_DIR = os.path.join(os.path.dirname(__file__), '..', 'report_images')

# Allow overriding headless mode and viewport via environment
HEADLESS = os.environ.get('HEADLESS', 'true').lower() in ('1', 'true', 'yes')
VIEWPORT_WIDTH = int(os.environ.get('VIEWPORT_WIDTH', '1400'))
VIEWPORT_HEIGHT = int(os.environ.get('VIEWPORT_HEIGHT', '1000'))

# Pages to capture (can be expanded)
PAGES = [
    ('home', '/'),
    ('shop', '/shop'),
    ('product_detail', '/shop?id=1'),
    ('about', '/about'),
    ('contact', '/contact'),
    ('blog', '/blog'),
    ('login', '/login'),
    ('profile', '/profile'),
    ('checkout', '/checkout'),
    ('admin_dashboard', '/admin/dashboard')
]

if not os.path.exists(OUT_DIR):
    os.makedirs(OUT_DIR, exist_ok=True)


def handle_dialog(dialog):
    try:
        dialog.accept()
    except Exception:
        pass


def main():
    with sync_playwright() as p:
        browser = p.chromium.launch(headless=HEADLESS)
        context = browser.new_context(viewport={"width": VIEWPORT_WIDTH, "height": VIEWPORT_HEIGHT})
        page = context.new_page()
        page.on('dialog', lambda dialog: handle_dialog(dialog))

        # Navigate to login and perform authentication
        login_url = BASE_URL.rstrip('/') + '/login'
        print('Navigating to login:', login_url)
        page.goto(login_url, wait_until='networkidle')

        # Try filling the common selectors
        try:
            page.fill('input[name="email"]', EMAIL)
            page.fill('input[name="password"]', PASSWORD)
            # Try clicking a submit button
            try:
                page.click('button[type="submit"]', timeout=3000)
            except Exception:
                try:
                    page.click('input[type="submit"]', timeout=3000)
                except Exception:
                    # fallback: submit the first form
                    page.evaluate("(function(){var f=document.querySelector('form'); if(f){f.submit();}})()")
        except Exception as e:
            print('Warning: không thể điền form tự động:', e)

        # Wait a bit to allow redirect and dynamic content
        try:
            page.wait_for_load_state('networkidle', timeout=8000)
        except Exception:
            pass

        # Capture pages
        for name, path in PAGES:
            url = BASE_URL.rstrip('/') + path
            try:
                print('Capturing', url)
                page.goto(url, wait_until='networkidle')
                # give JS a bit more time for dynamic elements
                try:
                    page.wait_for_timeout(1000)
                except Exception:
                    pass
                out = os.path.join(OUT_DIR, f'{name}.png')
                page.screenshot(path=out, full_page=True)
                print('Saved', out)
            except Exception as ex:
                print('Failed to capture', url, ex)

        browser.close()


if __name__ == '__main__':
    main()
