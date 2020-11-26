import Resource from '@/api/resource';
import request from '@/utils/request';

class ContactPersonResource extends Resource {
  constructor() {
    super('contact_persons');
  }

  relations() {
    return request({
      url: '/' + this.uri + '/relations',
      method: 'get',
    });
  }
}

export { ContactPersonResource as default };
