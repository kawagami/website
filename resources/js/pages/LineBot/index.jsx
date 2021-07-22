import React, { Component } from 'react'
import UndonePage from '../UndonePage'

export default class LineBot extends Component {
    render() {
        return (
            <div className="line-bot">
            <article className="map">
                <img src="https://i.imgur.com/aa9Onpd.png" alt="" />
                <img src="https://i.imgur.com/JY9yK6b.png" alt="" />
                <div className="content">使用LINE的給予地點資訊後可得到一個取得附近有什麼吃的地點的按鈕</div>
            </article>
                <article className="stock">
                    <img src="https://i.imgur.com/2r6ii9c.png" alt="" />
                    <img src="https://i.imgur.com/4p8w7fH.png" alt="" />
                    <div className="content">可使用設定好的詞語查詢目前股價損益</div>
                </article>
            </div>
        )
    }
}
