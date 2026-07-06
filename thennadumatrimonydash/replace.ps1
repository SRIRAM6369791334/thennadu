$files = @(
    "C:\xampp\htdocs\thennadumatrimony\thennadumatrimonydash\resources\views\pages\approvehoroscopeimg.blade.php",
    "C:\xampp\htdocs\thennadumatrimony\thennadumatrimonydash\resources\views\pages\approveprofileimg.blade.php",
    "C:\xampp\htdocs\thennadumatrimony\thennadumatrimonydash\resources\views\pages\horoscopeimg.blade.php",
    "C:\xampp\htdocs\thennadumatrimony\thennadumatrimonydash\resources\views\pages\pendinghoroscopeimg.blade.php",
    "C:\xampp\htdocs\thennadumatrimony\thennadumatrimonydash\resources\views\pages\pendingprofileimg.blade.php",
    "C:\xampp\htdocs\thennadumatrimony\thennadumatrimonydash\resources\views\pages\profileImages.blade.php",
    "C:\xampp\htdocs\thennadumatrimony\thennadumatrimonydash\resources\views\pages\video.blade.php"
)

foreach ($file in $files) {
    if (Test-Path $file) {
        $content = Get-Content $file -Raw
        $content = $content -replace 'https://varan2varan.com/public/images/', "{{ env('MAIN_URL') }}public/images/"
        $content = $content -replace 'https://thennadumatrimony.saitechnosolutions.in/public/images/', "{{ env('MAIN_URL') }}public/images/"
        $content = $content -replace 'https://thennadumatrimony.saitechnosolutions.inm/public/images/', "{{ env('MAIN_URL') }}public/images/"
        $content = $content -replace 'https://thennadumatrimony.saitechnosolutions.inm/public/videos/', "{{ env('MAIN_URL') }}public/videos/"
        Set-Content -Path $file -Value $content -Encoding UTF8
    }
}
