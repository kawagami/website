import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import bootstrap from './bootstrap'
import Axios from 'axios';
import Page from './components/Page'

export default class ReactContainer extends Component {

    state = {
        pages: [
            { id: 1, name: '頁面1', oldFlag: false, pageContent: 'pageContent1' }
        ]
    }

    componentDidUpdate(){
        // console.log('componentDidUpdate');
    }

    newPage = (params) => {
        // 將資料塞回ReactContainer 中的state
        const { chagngePage } = this

        const pageColor = `rgb(${Math.floor(Math.random() * 255)},${Math.floor(Math.random() * 255)},${Math.floor(Math.random() * 255)})`

        // 使用Axios打去後端要資料
        Axios.post('/test')
            .then(function (response) {
                const test = response.data
                // console.log(typeof test);

                // 將要顯示的頁面用axios取得，整理成newObj
                // 假資料
                const newObj = { id: Math.floor(Math.random() * 1000000), name: '測試資料1', oldFlag: false, pageContent: pageColor }

                // 將資料塞回ReactContainer 中的state
                chagngePage(newObj)
            });
    }

    clearOldPage = (newPage) => {
        // 1000ms 後舊資料移除(覆蓋)
        setTimeout(() => {
            if (newPage.oldFlag === true) {
                newPage.oldFlag = !newPage.oldFlag
            }
            this.setState({ pages: [newPage] })
        }, 290);
    }

    chagngePage = (pageObj) => {
        // 取得pageObj
        const { pages } = this.state
        let newPages = [...pages, pageObj]
        newPages = newPages.map((newPage) => {
            if (newPage.oldFlag === false) {
                newPage.oldFlag = !newPage.oldFlag
            }
            return newPage
        })

        // 將this.state.pages 更新
        this.setState({ pages: newPages })

        // 頁面變化動畫

        // 將this.state.pages 中的舊資料刪除
        this.clearOldPage(pageObj)
    }

    render() {
        const { pages } = this.state
        return (
            <div id="react-container">
                {pages.map((page) => {
                    return <Page key={page.id} page={page} newPage={this.newPage} />
                })}
            </div>
        )
    }
}

if (document.getElementById('react-main')) {
    ReactDOM.render(<ReactContainer />, document.getElementById('react-main'))
}
