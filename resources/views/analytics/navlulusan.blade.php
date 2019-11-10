<nav class="navbar-default" role="navigation">
<!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <a class="navbar-brand" href="#"><i class="fa fa-compass"></i> {{ ucfirst(trans('common.grad_graph')) }}</a>
    </div>

<!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav tab-graduates-graphtype">
            <li class="active">
                <a href="#graduates_graph_table_view">{{ ucfirst(trans('common.graph_table_view')) }}</a>
            </li>
            <li>
                <a href="#graduates_graph_bar_view">{{ ucfirst(trans('common.graph_bar_view')) }}</a>
            </li>
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>
