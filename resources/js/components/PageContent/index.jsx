import React, { Component } from 'react'

export default class PageContent extends Component {

    render() {
        const { id, name, oldFlag, pageContent } = this.props.page
        return (
            <div className={oldFlag ? 'page up_to_disappear' : 'page'} style={{ backgroundColor: pageContent }}>
                {id}
                <button className="btn btn-primary" onClick={this.props.newPage}>新增測試用資料</button>
            </div >
        )
    }
}
