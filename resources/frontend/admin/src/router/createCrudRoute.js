import { capitalize } from '@/utils';
const cap = capitalize

export const createCrudRoute = (options) => {

    const routes = [
        {
            path: options.basePath,
            icon: options.icon,
            title: options.title,
            name: `${cap(options.basePath)}s`,
            component: () =>  import(`@/pages/${cap(options.basePath)}/${cap(options.basePath)}s.vue`)
        },
        {
            path: `${options.basePath}/create`,
            name: `${cap(options.basePath)}Create`,
            component: () => import(`@/pages/${cap(options.basePath)}/${cap(options.basePath)}Detail.vue`)
        },
        {
            path: `${options.basePath}/:id`,
            name: `${cap(options.basePath)}Detail`,
            component: () => import(`@/pages/${cap(options.basePath)}/${cap(options.basePath)}Detail.vue`)
        },

    ]
    return routes;
}
