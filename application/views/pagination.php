<div class="pagination">
    <?php echo Pagination::factory(array(
        'total_items' => $total, 
        'view' => 'pagination/floating',
        'items_per_page' => 20,
        'current_page' => array(
            'source' => 'query_string',
            'key' => 'page',
        ),
    ))?> 
</div>

