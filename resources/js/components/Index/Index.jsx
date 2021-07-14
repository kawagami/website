import React, { Component } from 'react'
import MyNavLink from '../MyNavLink'

export default class Index extends Component {

    state = {
        categories: [
            { to: "/person", icon: "fa fa-user", mainTitle: "個人資料", subTitle: "瀏覽頁", slogan: "Survival of the fittest" },
            { to: "/function-list", icon: "fas fa-tools", mainTitle: "小功能", subTitle: "展示頁面", slogan: "Challenge Everything" },
            { to: "/project-list", icon: "fas fa-briefcase", mainTitle: "經歷專案", subTitle: "列表", slogan: "Think Different" },
            { to: "/email-me", icon: "fas fa-envelope", mainTitle: "電子郵件", subTitle: "連絡我", slogan: "Live Better" },
        ]
    }

    render() {
        const { categories } = this.state
        return (
            <div className="container">
                <div className="row">
                    <div className="twelve columns">
                        <ul className="ca-menu">
                            {
                                categories.map((category, index) => {
                                    return (
                                        <li key={index}>
                                            <MyNavLink to={category.to}>
                                                <span className="ca-icon">
                                                    <i className={category.icon}></i>
                                                </span>
                                                <div className="ca-content">
                                                    <h2 className="ca-main">
                                                        {category.mainTitle}
                                                        <br />
                                                        {category.subTitle}
                                                    </h2>
                                                    <h3 className="ca-sub">{category.slogan}</h3>
                                                </div>
                                            </MyNavLink>
                                        </li>
                                    )
                                })
                            }
                        </ul>
                    </div>
                </div>
            </div>
        )
    }
}
