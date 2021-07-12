import React, { Component } from 'react'

export default class Section extends Component {
    render() {
        const { title, icon, test } = this.props
        return (
            <section className="display-block">
                <h1>
                    {title}
                </h1>
                <i className={icon}></i>
            </section>
        )
    }
}
