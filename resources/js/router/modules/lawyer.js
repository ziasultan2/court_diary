/** When your routing table is too long, you can split it into small modules**/
import Layout from '@/layout';

const lawyerRoutes = {
  path: '/lawyer',
  component: Layout,
  name: 'Lawyer',
  meta: {
    permissions: [],
  },
  children: [
    {
        path: 'all',
        component: () => import('@/views/lawyer/index'),
        name: 'Lawyer',
        meta: { title: 'Lawyer', icon: 'el-icon-s-shop', noCache: true },
    },
  ],
};

export default lawyerRoutes;