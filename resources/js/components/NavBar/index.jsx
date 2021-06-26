import React, { Component } from 'react'
import MyNavLink from '../MyNavLink'

export default class NavBar extends Component {
    render() {
        return (
            <nav>
                <MyNavLink to="/">
                    <img src="https://pbs.twimg.com/media/EbhO1dRXQAcyUGl.png" alt="" />
                </MyNavLink>
            </nav>
        )
    }
}
