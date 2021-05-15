- laravel
    1. 環境建立
        * xampp
        * composer
        * node(需要內建的NPM)
        * VSCode(選用)
        * Git(選用)
        * composer create-project --prefer-dist laravel/laravel:^7.0 專案名稱
            - 會在當前目錄建立**專案名稱**的資料夾

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