@ECHO off
cls
:start
ECHO.
ECHO 1. Posting Pakai server custom (Spintax)
ECHO 2. Posting Pakai server gmail (Spintax)
ECHO 3. Posting Pakai server custom (tanpa Spintax)
ECHO 4. Posting Pakai server gmail (tanpa Spintax)

set choice=
set /p choice=Type the number to print text.
if not '%choice%'=='' set choice=%choice:~0,1%
if '%choice%'=='1' goto 1
if '%choice%'=='2' goto 2
if '%choice%'=='3' goto 3
if '%choice%'=='4' goto 4

ECHO "%choice%" Kleru Memek, Mletremu Kurang Akeh
ECHO.
goto start
:1
REM DIGUNAKAN UNTUK POSTING MENGGUNAKAN SERVER CUSTOM DENGAN Spintax
For /F "usebackq tokens=1-4  delims=," %%a in (list.csv) do (
php senderspintax.php %%c %%d %%a %%b mail.masuk.email 465 ssl
timeout /t 5
)
REM BATAS
goto end
:2
REM DIGUNAKAN UNTUK POSTING MENGGUNAKAN SERVER GMAIL DENGAN Spintax
For /F "usebackq tokens=1-4  delims=," %%a in (list.csv) do (
php senderspintax.php %%c %%d %%a %%b smtp.gmail.com 587 tls
timeout /t 5
)
goto end
:3
REM DIGUNAKAN UNTUK POSTING MENGGUNAKAN SERVER CUSTOM TANPA Spintax
For /F "usebackq tokens=1-4  delims=," %%a in (list.csv) do (
php sender.php %%c %%d %%a %%b mail.masuk.email 465 ssl
timeout /t 5
)
REM BATAS
goto end
:4
REM DIGUNAKAN UNTUK POSTING MENGGUNAKAN SERVER GMAIL TANPA Spintax
For /F "usebackq tokens=1-4  delims=," %%a in (list.csv) do (
php sender.php %%c %%d %%a %%b smtp.gmail.com 587 tls
timeout /t 5
)
goto end
:end
pause