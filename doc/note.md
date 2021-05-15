- laravel
    1. 環境建立
        * xampp
        * composer
        * node(需要內建的NPM)
        * VSCode(選用)
        * Git(選用)
        * composer create-project --prefer-dist laravel/laravel:^7.0 專案名稱
            - 會在當前目錄建立**專案名稱**的資料夾
        * 將laravel的前端框架改成react(選用)
            1. composer require laravel/ui "^2.0"
                - 給laravel7 用的 ^3.x => laravel^8.x
            2. php artisan ui react
            3. npm install
            4. npm run dev
                - npm run watch
                        - 這個指令能將每次 react 檔案存檔後自動編譯
                - [參考網址](https://medium.com/@JerrryWeng/%E5%AF%A6%E7%BF%92%E7%94%9F%E7%9A%84%E9%96%80%E7%A5%A8-4-%E4%BE%86%E5%81%9A%E5%80%8B%E7%B0%A1%E6%98%93-blog-%E5%90%A7-df49d596f638)  
                - [參考網址](https://www.ucamc.com/e-learning/php/379-laravel-5-%E4%BD%BF%E7%94%A8-reactjs-%E9%96%8B%E7%99%BC%E8%A8%AD%E5%AE%9A)                    
    2. 功能
        * 前台使用的member
            - [參考網址](https://ithelp.ithome.com.tw/articles/10226796)
        * 郵件驗證
            - [參考網址](https://ithelp.ithome.com.tw/articles/10224615)
        * Seed
            - [參考網址](https://ithelp.ithome.com.tw/articles/10227061)
        * User 權限分級
            - [參考網址](https://officeguide.cc/larave-6-implement-user-roles-and-permissions-using-gates/)
        * 會員權限設計
            - [參考網址](https://ithelp.ithome.com.tw/articles/10223360)
        * storage:link 路徑設置
            - [參考網址](https://ithelp.ithome.com.tw/articles/10231319)


- webpack
    0. 用來自動編譯一些檔案 參考web https://docs.laravel-dojo.com/laravel/5.5/mix
    1. 執行所有 Mix 任務
        * npm run dev
    2. 執行所有 Mix 任務和壓縮輸出
        * npm run production
    3. 即時監控資源的變化
        * npm run watch
            - 會在終端機持續執行，並監控所有相關檔案的變化。在 Webpack 檢測變化的時候，會自動重新編譯
            - 在檔案改變時，可以發現在某些環境下 Webpack 不會被更新。如果發生，請考慮使用 watch-poll 指令
                - npm run watch-poll

- javascript
    * 知識筆記
        * 短路求值 & 三元運算子 https://ithelp.ithome.com.tw/articles/10243261

- 新的知識
    * htmx
        - [參考網址](https://htmx.org/)
        - 簡單看了一下好像是能簡易使用ajax 的一種技術