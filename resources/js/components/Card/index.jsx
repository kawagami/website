import React, { Component } from 'react'

export default class Card extends Component {

    state = {
        categoryCard1: false,
        categoryCard2: false,
        categoryCard3: false,
        categoryCard4: false,
        categoryCard5: false,
    }
    handleClick = (event) => {
        return (params) => {
            this.setState({
                categoryCard1: false,
                categoryCard2: false,
                categoryCard3: false,
                categoryCard4: false,
                categoryCard5: false,
                [event]: true
            })
        }
    }

    render() {
        const { categoryCard1, categoryCard2, categoryCard3, categoryCard4, categoryCard5 } = this.state
        return (
            <div>
                <div id="category-card1" className={categoryCard1 ? 'anime_guruguru' : null} onMouseUp={this.handleClick('categoryCard1')}></div>
                <div id="category-card2" className={categoryCard2 ? 'anime_guruguru' : null} onMouseUp={this.handleClick('categoryCard2')}></div>
                <div id="category-card3" className={categoryCard3 ? 'anime_guruguru' : null} onMouseUp={this.handleClick('categoryCard3')}></div>
                <div id="category-card4" className={categoryCard4 ? 'anime_guruguru' : null} onMouseUp={this.handleClick('categoryCard4')}></div>
                <div id="category-card5" className={categoryCard5 ? 'anime_guruguru' : null} onMouseUp={this.handleClick('categoryCard5')}></div>
            </div>
        )
    }
}
