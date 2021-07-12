import React, { Component } from 'react'
import Section from '../../components/Section'
import MyNavLink from '../../components/MyNavLink'

export default class ProjectList extends Component {
    render() {
        return (
            <div className="inner-container">
                <ul>
                    <MyNavLink to="/proj-vote">
                        <li>
                            <Section title="投票網站" icon="fas fa-vote-yea" />
                        </li>
                    </MyNavLink>
                    <MyNavLink to="/proj-hardware">
                        <li>
                            <Section title="五金銷售網站" icon="fas fa-screwdriver" />
                        </li>
                    </MyNavLink>
                    <MyNavLink to="/proj-investment">
                        <li>
                            <Section title="投資商品網站" icon="fas fa-hand-holding-usd" />
                        </li>
                    </MyNavLink>
                    <MyNavLink to="/proj-choco">
                        <li>
                            <Section title="購物網站" icon="fas fa-shopping-cart" />
                        </li>
                    </MyNavLink>
                    <MyNavLink to="/proj-parking">
                        <li>
                            <Section title="停車場後台" icon="fas fa-car" />
                        </li>
                    </MyNavLink>
                    <MyNavLink to="/proj-payment">
                        <li>
                            <Section title="金流功能" icon="fas fa-coins" />
                        </li>
                    </MyNavLink>
                </ul>
            </div>
        )
    }
}
