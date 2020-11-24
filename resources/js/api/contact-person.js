import Resource from '@/api/resource';

class ContactPersonResource extends Resource {
  constructor() {
    super('contact_persons');
  }
}

export { ContactPersonResource as default };
