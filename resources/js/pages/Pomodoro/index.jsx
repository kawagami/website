import React, { Component } from 'react'

export default class Pomodoro extends Component {

    componentDidMount() {
        const hourHand = document.querySelector('.hour-hand')
        const minHand = document.querySelector('.min-hand')
        const secondHand = document.querySelector('.second-hand')

        // 將時、分、秒針擺到對應時間的位置
        const date = new Date
        secondHand.style.transform = `rotate(calc((90deg + ${date.getSeconds() * 6}deg)))`
        minHand.style.transform = `rotate(calc((90deg + ${date.getMinutes() * 6}deg)))`
        hourHand.style.transform = `rotate(calc((90deg + ${date.getHours() * 30}deg)))`
        // 建立一個移動1/60圈的function
        function handleTimeChange(event) {
            const innerTime = new Date
            event.style.transform = `rotate(calc((90deg + ${innerTime.getSeconds() * 6}deg)))`
            minHand.style.transform = `rotate(calc((90deg + ${innerTime.getMinutes() * 6}deg)))`
            hourHand.style.transform = `rotate(calc((90deg + ${innerTime.getHours() * 30}deg)))`
        }

        this.timer = setInterval(() => {
            handleTimeChange(secondHand)
        }, 1000);
    }

    componentWillUnmount() {
        clearInterval(this.timer)
    }

    render() {
        return (
            <div className="clock">
                <div className="clock-face">
                    <div className="hand hour-hand"></div>
                    <div className="hand min-hand"></div>
                    <div className="hand second-hand"></div>
                </div>
            </div>
        )
    }
}
