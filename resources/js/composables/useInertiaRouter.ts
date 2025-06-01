// composables/useInertiaRouter.ts
import { router } from '@inertiajs/vue3';

const defaultOptions = {
    preserveScroll: true,
    preserveState: true,
};

export function useInertiaRouter() {
    return {
        visit: (url: string, options = {}) => {
            return router.visit(url, { ...defaultOptions, ...options });
        },
        get: (url: string, options = {}) => {
            return router.get(url, { ...defaultOptions, ...options });
        },
        post: (url: string, data: any, options = {}) => {
            return router.post(url, data, { ...defaultOptions, ...options });
        },
        put: (url: string, data: any, options = {}) => {
            return router.put(url, data, { ...defaultOptions, ...options });
        },
        patch: (url: string, data: any, options = {}) => {
            return router.patch(url, data, { ...defaultOptions, ...options });
        },
        delete: (url: string, options = {}) => {
            return router.delete(url, { ...defaultOptions, ...options });
        },
    };
}
