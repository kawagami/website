- 整理一下想做的內容
    * 主頁只有一頁
    * 換頁
    * 主框只顯示寬100%、高100vh，overflow的就會hidden
        - 用非同步將資料貼在頁面下方(100vh~200vh)
        - 頁面資料上移-100vh
        - 將位於-100vh~0的資料刪去
            * structure 資料結構
                - react-main
                    - react-container
                        - id-page (當前頁面)
                        - id-page (新頁面)
                1. 第一層component react-container 綁在react-main
                2. 在react-container state控制頁面顯示
                3. 頁面內容在id-page 調整，要能夠修改react-container 的state(新增page、修改現在page為舊page)

- 20210523
    * 目前做到用取得的資料更新頁面這步，遇到react有擋外部資料成為html結構的樣子
        - 預計換成規則內的用法，每個頁面做個component，在state資料中多一欄判斷是哪個頁面的，用來render 相對應的component
        