import React, { Component } from 'react'

export default class Section extends Component {
    render() {
        const { title, content } = this.props
        return (
            <section className="display-block">
                <h1>{title}</h1>
                <span>{content}</span>
            </section>
        )
    }
}
