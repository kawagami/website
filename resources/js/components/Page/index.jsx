import React, { Component } from 'react'
import PageContent from '../PageContent'

export default class Page extends Component {

    render() {
        const { page, newPage } = this.props
        return (
            <PageContent page={page} newPage={newPage} />
        )
    }
}
