@echo off
setlocal

:: Default IP address
set "local_ip=127.0.0.1"

:: Try to get the first non-loopback IPv4 address
for /f "tokens=2 delims=:" %%f in ('ipconfig ^| findstr /i "IPv4" ^| findstr /v "127.0.0.1"') do (
    set "local_ip=%%f"
    goto after_loop
)

:after_loop
:: Clean up whitespace
setlocal enabledelayedexpansion
set "local_ip=!local_ip: =!"

:: Set the port
set "port=8003"

echo.
echo Using IP: %local_ip%
echo Opening Application at: http://%local_ip%:%port%
echo.

:: Open the app in your default browser
start http://%local_ip%:%port%

:: Change directory to your Laravel project
cd /d "E:\xampp\htdocs\schoolmgt

:: Start Laravel server
php artisan serve --host=%local_ip% --port=%port%

pause
