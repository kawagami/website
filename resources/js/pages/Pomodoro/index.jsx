import React, { Component } from 'react'

export default class Pomodoro extends Component {

    componentDidMount() {
        const hourHand = document.querySelector('.hour-hand')
        const minHand = document.querySelector('.min-hand')
        const secondHand = document.querySelector('.second-hand')
        const numberHourHand = document.querySelector('.number-hour-hand')
        const numberMinHand = document.querySelector('.number-min-hand')
        const numberSecondHand = document.querySelector('.number-second-hand')

        // 將時、分、秒針擺到對應時間的位置
        const date = new Date
        secondHand.style.transform = `rotate(calc((90deg + ${date.getSeconds() * 6}deg)))`
        minHand.style.transform = `rotate(calc((90deg + ${date.getMinutes() * 6}deg)))`
        hourHand.style.transform = `rotate(calc((90deg + ${date.getHours() * 30}deg + ${date.getMinutes() / 2}deg)))`
        numberHourHand.innerText = date.getHours().toString().padStart(2, '0')
        numberMinHand.innerText = date.getMinutes().toString().padStart(2, '0')
        numberSecondHand.innerText = date.getSeconds().toString().padStart(2, '0')
        // 建立一個移動1/60圈的function
        function handleTimeChange() {
            const innerTime = new Date
            secondHand.style.transform = `rotate(calc((90deg + ${innerTime.getSeconds() * 6}deg)))`
            minHand.style.transform = `rotate(calc((90deg + ${innerTime.getMinutes() * 6}deg)))`
            hourHand.style.transform = `rotate(calc((90deg + ${innerTime.getHours() * 30}deg + ${innerTime.getMinutes() / 2}deg)))`
            numberHourHand.innerText = innerTime.getHours().toString().padStart(2, '0')
            numberMinHand.innerText = innerTime.getMinutes().toString().padStart(2, '0')
            numberSecondHand.innerText = innerTime.getSeconds().toString().padStart(2, '0')
        }

        this.timer = setInterval(() => {
            handleTimeChange()
        }, 1000);
    }

    componentWillUnmount() {
        clearInterval(this.timer)
    }

    render() {
        return (
            <div className="pomodoro">
                <div className="clock">
                    <div className="clock-face">
                        <div className="hand hour-hand"></div>
                        <div className="hand min-hand"></div>
                        <div className="hand second-hand"></div>
                    </div>
                </div>
                <div className="number-clock">
                    <div className="number-clock-face">
                        <div className="number-hand number-hour-hand"></div>
                        <div className="colon">&nbsp;:&nbsp;</div>
                        <div className="number-hand number-min-hand"></div>
                        <div className="colon">&nbsp;:&nbsp;</div>
                        <div className="number-hand number-second-hand"></div>
                    </div>
                </div>
            </div>
        )
    }
}
