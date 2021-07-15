const initState = false

export default function loadingReducer(preState = initState, action) {
    const { type, data } = action
    switch (type) {
        case 'up':
            return true
        case 'down':
            return false
        default:
            return preState
    }
}