<?php
use Illuminate\Support\Facades\Http;

while (true) {
    Http::get('https://web-site-react.herokuapp.com');
    sleep(60);
}
