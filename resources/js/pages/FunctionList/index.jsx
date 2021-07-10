import React, { Component } from 'react'
import Section from '../Section'
import MyNavLink from '../../components/MyNavLink'

export default class FunctionList extends Component {
    render() {
        return (
            <div className="inner-container">
                <ul>
                    <MyNavLink to="/pomodoro">
                        <li>
                            <Section title="番茄鐘" content="內容文字" />
                        </li>
                    </MyNavLink>
                    <MyNavLink to="/stock-computer">
                        <li>
                            <Section title="股票計算機" content="內容文字" />
                        </li>
                    </MyNavLink>
                    <MyNavLink to="/weather-card">
                        <li>
                            <Section title="天氣卡片" content="內容文字" />
                        </li>
                    </MyNavLink>
                    <MyNavLink to="/random-vocabulary">
                        <li>
                            <Section title="隨機英文單字" content="內容文字" />
                        </li>
                    </MyNavLink>
                </ul>
            </div>
        )
    }
}
