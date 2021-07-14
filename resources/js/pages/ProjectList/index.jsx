import React, { Component } from 'react'
import Section from '../../components/Section'
import MyNavLink from '../../components/MyNavLink'

export default class ProjectList extends Component {
    render() {
        return (
            <div className="inner-container">
                <ul>
                    <li>
                        <MyNavLink to="/proj-vote">
                            <Section title="投票網站" icon="fas fa-vote-yea" />
                        </MyNavLink>
                    </li>
                    <li>
                        <MyNavLink to="/proj-hardware">
                            <Section title="五金銷售網站" icon="fas fa-screwdriver" />
                        </MyNavLink>
                    </li>
                    <li>
                        <MyNavLink to="/proj-investment">
                            <Section title="投資商品網站" icon="fas fa-hand-holding-usd" />
                        </MyNavLink>
                    </li>
                    <li>
                        <MyNavLink to="/proj-choco">
                            <Section title="購物網站" icon="fas fa-shopping-cart" />
                        </MyNavLink>
                    </li>
                    <li>
                        <MyNavLink to="/proj-parking">
                            <Section title="停車場後台" icon="fas fa-car" />
                        </MyNavLink>
                    </li>
                    <li>
                        <MyNavLink to="/proj-payment">
                            <Section title="金流功能" icon="fas fa-coins" />
                        </MyNavLink>
                    </li>
                </ul>
            </div>
        )
    }
}
