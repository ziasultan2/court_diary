/** When your routing table is too long, you can split it into small modules**/
import Layout from '@/layout';

const customerRoutes = {
  path: '/customer',
  component: Layout,
  name: 'Customer',
  meta: {
    permissions: [],
  },
  children: [
    {
        path: 'all',
        component: () => import('@/views/customer/index'),
        name: 'Customer',
        meta: { title: 'Customer', icon: 'el-icon-s-shop', noCache: true },
    },
  ],
};

export default customerRoutes;