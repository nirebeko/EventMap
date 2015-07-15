Ext.define('SenchaTouchMVC.store.Posts', {
    extend: 'Ext.data.Store',
    config: {
        model: 'SenchaTouchMVC.model.Post',
        sorters: [
              {
                property: 'title',
                direction: 'DESC'
              }
        ],
        grouper : function(record) {
            return record.get('title')[0];
        },
        storeId: 'postStore',
        autoLoad: true
    }
});
