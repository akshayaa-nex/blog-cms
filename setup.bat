@echo off
REM Blog CMS Setup Script for Windows
REM This script helps you set up the Blog CMS locally

echo.
echo ========================================
echo Blog CMS Installation Guide (Windows)
echo ========================================
echo.

REM Check if composer is installed
where composer >nul 2>nul
if %ERRORLEVEL% NEQ 0 (
    echo ERROR: Composer is not installed or not in PATH
    echo Please install Composer first: https://getcomposer.org/download/
    pause
    exit /b 1
)

echo [OK] Composer found
echo.

REM Install dependencies
echo Installing PHP dependencies...
call composer install

if not exist .env (
    echo Creating .env file...
    copy env .env
    echo WARNING: Please update .env with your database credentials
)

echo.
echo Setting up database...
echo Please ensure MySQL/MariaDB is running and you have created the database.
echo.

REM Run migrations
echo Running migrations...
call php spark migrate

echo.
echo [SUCCESS] Installation complete!
echo.
echo Next steps:
echo 1. Update .env file with your database credentials
echo 2. Run: php spark serve
echo 3. Visit: http://localhost:8080
echo.
echo For API Documentation: Check README.md
echo.
pause
