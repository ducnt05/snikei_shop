# Capture screenshots of public pages using Chrome headless.
# Usage (PowerShell):
#   .\capture_screenshots.ps1 -BaseUrl "http://localhost/snikei_shop/public" -OutputDir "..\report_images"
# Requirements: Google Chrome or Edge installed. Adjust $chromePaths if necessary.
param(
    [string]$BaseUrl = "http://localhost/snikei_shop/public",
    [string]$OutputDir = "..\report_images",
    [int]$Width = 1280,
    [int]$Height = 900
)

# Common Chrome installation paths to try
$chromePaths = @(
    "$env:ProgramFiles\Google\Chrome\Application\chrome.exe",
    "$env:ProgramFiles(x86)\Google\Chrome\Application\chrome.exe",
    "$env:ProgramFiles\Microsoft\Edge\Application\msedge.exe",
    "$env:LOCALAPPDATA\Microsoft\Edge\Application\msedge.exe"
)

$chrome = $chromePaths | Where-Object { Test-Path $_ } | Select-Object -First 1
if (-not $chrome) {
    Write-Error "Không tìm thấy Chrome/Edge. Vui lòng cài Chrome/Edge hoặc sửa đường dẫn trong script."; exit 1
}

# Ensure output directory exists
$fullOut = Join-Path -Path (Split-Path -Parent $MyInvocation.MyCommand.Definition) -ChildPath $OutputDir
if (-not (Test-Path $fullOut)) { New-Item -ItemType Directory -Path $fullOut | Out-Null }

# Pages to capture (relative to BaseUrl). You can add/remove entries.
$pages = @(
    @{name='home'; path='/'},
    @{name='shop'; path='/shop'},
    @{name='product_detail'; path='/shop?id=1'},
    @{name='about'; path='/about'},
    @{name='contact'; path='/contact'},
    @{name='blog'; path='/blog'},
    @{name='login'; path='/login'}
)

foreach ($p in $pages) {
    $url = $BaseUrl.TrimEnd('/') + $p.path
    $out = Join-Path $fullOut ("$($p.name).png")
    Write-Host "Capturing $url -> $out"
    & "$chrome" --headless --disable-gpu --hide-scrollbars --screenshot="$out" --window-size=${Width},${Height} $url
    Start-Sleep -Milliseconds 300
}

Write-Host "Screenshots saved to: $fullOut"
Write-Host "Notes:"
Write-Host " - Pages requiring login (profile, checkout, admin) will redirect to login; to capture them you must login manually in a browser and then save screenshots by hand or use an automated browser script with login credentials."
Write-Host " - After you collect screenshots, run the Python script to insert them into the DOCX: scripts/insert_screenshots_into_docx.py"