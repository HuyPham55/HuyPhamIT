import {defineStore} from 'pinia';
import {ref} from 'vue';

type EventCallback = (...args: any[]) => void;

export const useEventBusStore = defineStore('eventBus', () => {
    const events = ref<Map<string, EventCallback[]>>(new Map());

    // Emit an event
    function emit(event: string, ...args: any[]) {
        const callbacks = events.value.get(event);
        if (callbacks) {
            callbacks.forEach(callback => {
                callback(...args);
            });
        }
    }

    // Register a listener for an event
    function on(event: string, callback: EventCallback) {
        if (!events.value.has(event)) {
            events.value.set(event, []);
        }
        events.value.get(event)?.push(callback);
    }

    // Remove a listener for an event
    function off(event: string, callback: EventCallback) {
        const callbacks = events.value.get(event);
        if (callbacks) {
            const index = callbacks.indexOf(callback);
            if (index !== -1) {
                callbacks.splice(index, 1);
            }
        }
    }

    return {
        emit,
        on,
        off,
    };
});