import React, { Component } from 'react'
import MyNavLink from '../MyNavLink'

export default class NavBar extends Component {
    render() {
        return (
            <nav>
                <MyNavLink to="/">
                    <img src="https://i.imgur.com/epdARNq.png" alt="" />
                </MyNavLink>
            </nav>
        )
    }
}
