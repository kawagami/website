# 紀錄leetcode SQL 練習紀錄
##
* ![hackMD筆記](https://hackmd.io/@kawagami/B1x1IjF3O)
## 20210720開始
* 175
    * 合併兩表
        * 使用jeft join即可
* 176
    * 取得employee次高薪資，無次高時null
    * IFNULL(如果這裡沒有,回傳這個)
    * ORDER BY 欄位 DESC
    * DISTINCT 整理重複數值
    * LIMIT 要幾筆 OFFSET 跳過幾筆
* 181
    * 取得employee比manager高薪水的name as Employee
    * SQL92自連結
    * where條件要搞懂連結的欄位為什麼是這個、做了什麼
* 182
    * 取得有重複名稱的Email
    * group by & having & count() 的應用
* 183 
    * 取得沒點任何東西的顧客
    * SQL99 LEFT JOIN 
    * WHERE Orders.CustomerId IS NULL 即為所求
## 20210721
* 196
    * 刪除在資料庫內重複的Email，留下ID最小的EMAIL
    * DELETE (ALIAS) FROM TableName (AS ALIAS) WHERE 條件
* 197
    * 取得比昨天(前一天)溫度還高的日期ID
    * DATEDIFF(拿這個, 減這個) = 差值
* 595
    * 


