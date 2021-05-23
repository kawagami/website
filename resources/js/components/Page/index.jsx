import React, { Component } from 'react'

export default class Page extends Component {

    newPage = (params) => {

        const newObj = { id: Math.floor(Math.random() * 1000000), name: '測試資料1', oldFlag: false, pageContent: '測試資料content1' }
        // console.log(newObj);

        this.props.chagngePage(newObj)
    }

    render() {
        const { id, name, oldFlag, pageContent } = this.props.page
        return (
            <div className={oldFlag ? 'page up_to_disappear' : 'page'}>
                <div>{id}</div>
                <div>{name}</div>
                <div>{oldFlag}</div>
                <div>{pageContent}</div>
                <button className="btn btn-primary" onClick={this.newPage}>新增測試用資料</button>
            </div >
        )
    }
}
