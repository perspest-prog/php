import { useEcho } from "@laravel/echo-react";
import { useState } from "react";

interface ThingData {
    thing: {
        id: number
        name: string
        description: string
    }
}

const NotificationHandler = () => {
    const [ thing, setThing ] = useState<ThingData['thing']>()
    const [ isShown, setIsShown ] = useState(false)

    const { listen, channel } = useEcho<ThingData>('notifications', [ 'ThingCreated', 'PlaceCreated' ], ({ thing }) => {
        setThing(thing)
        setIsShown(true)
        

        setTimeout(() => setIsShown(false), 3000)
    })

    return (
        <div>
            <h2 style={{display: isShown ? 'inline' : 'none'}}>Создалась новая вещь { thing?.name }!</h2>
        </div>
    )
}

export default NotificationHandler