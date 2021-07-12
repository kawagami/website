import React, { Component } from 'react'

export default class EmailMe extends Component {

    back=() => {
        this.props.history.goBack()
    }

    render() {
        return (
            <div className="email-container">
                <div className="email-mid">
                    <label htmlFor="title">
                        <span>標題</span>
                        <input name="title" type="text" />
                    </label>
                    <label htmlFor="content">
                        <span>內文</span>
                        <textarea name="content" id="content" cols="30" rows="10"></textarea>
                    </label>
                    <div className="action">
                        <button onClick={this.back}>取消</button>
                        <button>寄出</button>
                    </div>
                </div>
            </div>
        )
    }
}
