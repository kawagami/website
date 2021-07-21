import Axios from 'axios'
import React, { Component } from 'react'
import store from '../../redux/store'

export default class EmailMe extends Component {

    state = {
        type: 'job',
        content: '',
    }

    loadingUp = () => {
        store.dispatch({ type: 'up', data: '' })
    }

    loadingDown = () => {
        store.dispatch({ type: 'down', data: '' })
    }

    handleInput = (e) => {
        // console.log(e.target.value);
        // console.log(e.target.id);
        this.setState({ [e.target.id]: e.target.value })
    }

    handleSendMail = () => {
        this.loadingUp()
        const url = "/api/contact-me"
        const { type, content } = this.state
        const data = { type: type, content: content }
        Axios.post(url, data).then(
            response => {
                this.loadingDown()
                this.back()
            }
        )
    }

    back = () => {
        this.props.history.goBack()
    }

    render() {
        const { content } = this.state
        return (
            <div className="email-container">
                <div className="email-mid">
                    <label htmlFor="type">
                        <span>主題類型</span>
                        <select name="type" id="type" onChange={this.handleInput}>
                            <option value="job">工作</option>
                            <option value="suggest">建議</option>
                            <option value="other">其他</option>
                        </select>
                    </label>
                    <label htmlFor="content">
                        <span>內文</span>
                        <textarea name="content" id="content" cols="30" rows="10" onChange={this.handleInput} value={content}></textarea>
                    </label>
                    <div className="action">
                        <button onClick={this.back}>取消</button>
                        <button onClick={this.handleSendMail}>寄出</button>
                    </div>
                </div>
            </div>
        )
    }
}
