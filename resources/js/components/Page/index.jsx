import Axios from 'axios';
import React, { Component } from 'react'

export default class Page extends Component {

    newPage = (params) => {
        // 將資料塞回ReactContainer 中的state
        const { chagngePage } = this.props

        // 使用Axios打去後端要資料
        Axios.post('/test')
            .then(function (response) {
                const test = response.data
                // console.log(typeof test);

                // 將要顯示的頁面用axios取得，整理成newObj
                // 假資料
                const newObj = { id: Math.floor(Math.random() * 1000000), name: '測試資料1', oldFlag: false, pageContent: test }

                chagngePage(newObj)
            });
    }

    render() {
        const { id, name, oldFlag, pageContent } = this.props.page
        return (
            <div className={oldFlag ? 'page up_to_disappear' : 'page'}>
                {pageContent}
                <button className="btn btn-primary" onClick={this.newPage}>新增測試用資料</button>
            </div >
        )
    }
}
