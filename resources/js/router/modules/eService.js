/** When your routing table is too long, you can split it into small modules**/
import Layout from '@/layout';

const eServiceRoutes = {
  path: '/eservice',
  component: Layout,
  name: 'EService',
  meta: {
    permissions: [],
  },
  children: [
    {
        path: 'all',
        component: () => import('@/views/eservice/index'),
        name: 'EService',
        meta: { title: 'EService', icon: 'el-icon-s-shop', noCache: true },
    },
  ],
};

export default eServiceRoutes;