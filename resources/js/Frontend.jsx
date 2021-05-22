import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import Card from './components/Card'

export default class Frontend extends Component {

    render() {
        return (
            <Card />
        )
    }
}

if (document.getElementById('react-card')) {
    ReactDOM.render(<Frontend />, document.getElementById('react-card'))
}
