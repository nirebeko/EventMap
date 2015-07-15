Ext.define('SenchaTouchMVC.view.PostView', {
    extend: 'Ext.navigation.View',
    xtype: 'userview',
    requires: [
        'SenchaTouchMVC.view.PostList'
    ],
    fullscreen: true,
    config: {
        items: [
            {
                xtype: 'postList'
            },
            {
                xtype: 'toolbar',
                docked: 'bottom',
                items: [
                    {
                        xtype: 'button',
                        text: 'Neu',
                        itemId: 'postnew'
                        
                    }
                ]
                
            }
        ]
        
          
    }
    
});