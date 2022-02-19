/** When your routing table is too long, you can split it into small modules**/
import Layout from '@/layout';

const courtRoutes = {
  path: '/court',
  component: Layout,
  name: 'Court',
  meta: {
    permissions: [],
  },
  children: [
    {
        path: 'all',
        component: () => import('@/views/court/index'),
        name: 'Court',
        meta: { title: 'Court', icon: 'el-icon-s-shop', noCache: true },
    },
  ],
};

export default courtRoutes;