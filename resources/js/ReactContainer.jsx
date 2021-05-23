import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import Page from './components/Page'

export default class ReactContainer extends Component {

    state = {
        pages: [
            { id: 1, name: '頁面1', oldFlag: false, pageContent: 'pageContent1' }
        ]
    }

    clearOldPage = (newPage) => {
        // 1000ms 後舊資料移除(覆蓋)
        setTimeout(() => {
            if (newPage.oldFlag === true) {
                newPage.oldFlag = !newPage.oldFlag
            }
            this.setState({ pages: [newPage] })
        }, 1000);
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
                    return <Page key={page.id} page={page} chagngePage={this.chagngePage} />
                })}
            </div>
        )
    }
}

if (document.getElementById('react-main')) {
    ReactDOM.render(<ReactContainer />, document.getElementById('react-main'))
}
