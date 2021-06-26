import React, { Component } from 'react'
import MyNavLink from '../MyNavLink'

export default class Index extends Component {
    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="twelve columns">
                        <ul className="ca-menu">
                            <MyNavLink to="/function-list">
                                <li>
                                    <span className="ca-icon">
                                        <i className="fas fa-tools"></i>
                                    </span>
                                    <div className="ca-content">
                                        <h2 className="ca-main">
                                            小功能
                                            <br />
                                            展示頁面
                                        </h2>
                                        <h3 className="ca-sub">Just Do It</h3>
                                    </div>
                                </li>
                            </MyNavLink>
                            <MyNavLink to="/person">
                                <li>
                                    <span className="ca-icon">
                                        <i className="fa fa-user"></i>
                                    </span>
                                    <div className="ca-content">
                                        <h2 className="ca-main">
                                            個人資料
                                            <br />
                                            瀏覽頁
                                        </h2>
                                        <h3 className="ca-sub">Challenge Everything</h3>
                                    </div>
                                </li>
                            </MyNavLink>
                            <li>
                                <span className="ca-icon">
                                    <i className="fa fa-bullhorn"></i>
                                </span>
                                <div className="ca-content">
                                    <h2 className="ca-main">
                                        Friendly
                                        <br />
                                        Documentation
                                    </h2>
                                    <h3 className="ca-sub">Live Better</h3>
                                </div>
                            </li>
                            <li>
                                <span className="ca-icon">
                                    <i className="fa fa-camera"></i>
                                </span>
                                <div className="ca-content">
                                    <h2 className="ca-main">
                                        Filterable
                                        <br />
                                        Portofolio
                                    </h2>
                                    <h3 className="ca-sub">Think Different</h3>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        )
    }
}
