import React, { Component } from 'react'

export default class EmailMe extends Component {

    back=() => {
        this.props.history.goBack()
    }

    render() {
        return (
            <div className="email-container">
                <div className="email-mid">
                    <label htmlFor="type">
                        <span>主題類型</span>
                        <select name="type" id="type">
                            <option value="job">工作</option>
                            <option value="suggest">建議</option>
                            <option value="other">其他</option>
                        </select>
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
