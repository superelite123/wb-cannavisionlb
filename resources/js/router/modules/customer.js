/** When your routing table is too long, you can split it into small modules**/
import Layout from '@/layout';

const customerRoutes = {
  path: '/customer_relations',
  component: Layout,
  redirect: '/customer/customers',
  name: 'Customer Relations',
  alwaysShow: true,
  meta: {
    title: 'customer',
    icon: 'admin',
    permissions: ['view menu customer relation'],
  },
  children: [
    {
      path: 'customers',
      component: () => import('@/views/customers/Archive'),
      name: 'CustomerList',
      meta: { title: 'Customers', icon: 'user', permissions: ['manage customer'] },
    },
    {
      path: 'contact_persons',
      component: () => import('@/views/contact-person/Archive'),
      name: 'ContactPersonList',
      meta: { title: 'Person', icon: 'user', permissions: ['manage customer'] },
    },
  ],
};

export default customerRoutes;
