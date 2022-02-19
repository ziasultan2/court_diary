/** When your routing table is too long, you can split it into small modules**/
import Layout from '@/layout';

const bookRoutes = {
  path: '/book',
  component: Layout,
  name: 'Book',
  meta: {
    permissions: [],
  },
  children: [
    {
        path: 'all',
        component: () => import('@/views/book/index'),
        name: 'Book',
        meta: { title: 'Book', icon: 'el-icon-s-shop', noCache: true },
    },
  ],
};

export default bookRoutes;