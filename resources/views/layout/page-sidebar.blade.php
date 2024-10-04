<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        @can('user-view')
            <li class="nav-item">
                <a class="nav-link " href="{{ url('/home') }}">
                    <i class="bi bi-grid"></i>
                    <span>Tableau de bord</span>
                </a>
            </li><!-- End Dashboard Nav -->
        @endcan

        {{-- <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Components</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="components-alerts.html">
                        <i class="bi bi-circle"></i><span>Alerts</span>
                    </a>
                </li>
                <li>
                    <a href="components-accordion.html">
                        <i class="bi bi-circle"></i><span>Accordion</span>
                    </a>
                </li>
                <li>
                    <a href="components-badges.html">
                        <i class="bi bi-circle"></i><span>Badges</span>
                    </a>
                </li>
                <li>
                    <a href="components-breadcrumbs.html">
                        <i class="bi bi-circle"></i><span>Breadcrumbs</span>
                    </a>
                </li>
                <li>
                    <a href="components-buttons.html">
                        <i class="bi bi-circle"></i><span>Buttons</span>
                    </a>
                </li>
                <li>
                    <a href="components-cards.html">
                        <i class="bi bi-circle"></i><span>Cards</span>
                    </a>
                </li>
                <li>
                    <a href="components-carousel.html">
                        <i class="bi bi-circle"></i><span>Carousel</span>
                    </a>
                </li>
                <li>
                    <a href="components-list-group.html">
                        <i class="bi bi-circle"></i><span>List group</span>
                    </a>
                </li>
                <li>
                    <a href="components-modal.html">
                        <i class="bi bi-circle"></i><span>Modal</span>
                    </a>
                </li>
                <li>
                    <a href="components-tabs.html">
                        <i class="bi bi-circle"></i><span>Tabs</span>
                    </a>
                </li>
                <li>
                    <a href="components-pagination.html">
                        <i class="bi bi-circle"></i><span>Pagination</span>
                    </a>
                </li>
                <li>
                    <a href="components-progress.html">
                        <i class="bi bi-circle"></i><span>Progress</span>
                    </a>
                </li>
                <li>
                    <a href="components-spinners.html">
                        <i class="bi bi-circle"></i><span>Spinners</span>
                    </a>
                </li>
                <li>
                    <a href="components-tooltips.html">
                        <i class="bi bi-circle"></i><span>Tooltips</span>
                    </a>
                </li>
            </ul>
        </li> --}}
        <!-- End Components Nav -->

        {{-- <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Forms</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="forms-elements.html">
                        <i class="bi bi-circle"></i><span>Form Elements</span>
                    </a>
                </li>
                <li>
                    <a href="forms-layouts.html">
                        <i class="bi bi-circle"></i><span>Form Layouts</span>
                    </a>
                </li>
                <li>
                    <a href="forms-editors.html">
                        <i class="bi bi-circle"></i><span>Form Editors</span>
                    </a>
                </li>
                <li>
                    <a href="forms-validation.html">
                        <i class="bi bi-circle"></i><span>Form Validation</span>
                    </a>
                </li>
            </ul>
        </li> --}}
        <!-- End Forms Nav -->

        {{-- <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="tables-general.html">
                        <i class="bi bi-circle"></i><span>General Tables</span>
                    </a>
                </li>
                <li>
                    <a href="tables-data.html">
                        <i class="bi bi-circle"></i><span>Data Tables</span>
                    </a>
                </li>
            </ul>
        </li> --}}
        <!-- End Tables Nav -->

        {{-- <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-bar-chart"></i><span>Charts</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="charts-chartjs.html">
                        <i class="bi bi-circle"></i><span>Chart.js</span>
                    </a>
                </li>
                <li>
                    <a href="charts-apexcharts.html">
                        <i class="bi bi-circle"></i><span>ApexCharts</span>
                    </a>
                </li>
                <li>
                    <a href="charts-echarts.html">
                        <i class="bi bi-circle"></i><span>ECharts</span>
                    </a>
                </li>
            </ul>
        </li> --}}
        <!-- End Charts Nav -->
        {{-- @if (auth()->user()->hasRole('super-admin|courrier|a-courrier')) --}}
        @can('courrier-view')
            {{-- <li class="nav-heading">Gestion courrier</li> --}}
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#courrier-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-envelope"></i><span>Gestion courrier</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="courrier-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('courriers') }}">
                            <span>Courriers</span>
                        </a>
                    </li><!-- End arrives Nav -->
                    @can('arrive-view')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ url('arrives') }}">
                                <span>Arrivé</span>
                            </a>
                        </li><!-- End arrives Nav -->
                    @endcan

                    @can('depart-view')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ url('departs') }}">
                                <span>Départ</span>
                            </a>
                        </li><!-- End departs Nav -->
                    @endcan

                    @can('interne-view')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="#">
                                <span>Interne</span>
                            </a>
                        </li><!-- End internes Nav -->
                    @endcan
                </ul>
            </li><!-- End Courriers Nav -->
        @endcan
        {{-- @endif --}}
        {{-- <li class="nav-heading">Gestion demandeurs</li> --}}
        {{-- @if (auth()->user()->hasRole('super-admin|DIOF|ADIOF')) --}}
        @can('demande-view')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#demande-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-folder-plus"></i><span>Gestion demandeurs</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="demande-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    @can('individuelle-view')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ url('individuelles') }}">
                                <span>Demandes individuelles</span>
                            </a>
                        </li><!-- End individuelles Nav -->
                    @endcan

                    @can('collective-view')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ url('collectives') }}">
                                <span>Demandes collectives</span>
                            </a>
                        </li><!-- End collectives Nav -->
                    @endcan

                    @can('pcharge-view')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="#">
                                <span>Demandes prise en charge</span>
                            </a>
                        </li><!-- End Prise en charges Nav -->
                    @endcan

                </ul>
            </li><!-- End demandes Nav -->
        @endcan
        {{-- @endif --}}
        {{-- @if (auth()->user()->hasRole('Demandeur')) --}}
        @can('demandeur-view')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#demandeurs-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-folder-plus"></i><span>Mes demandes</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="demandeurs-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ route('demandesIndividuelle') }}">
                            <span>Individuelles</span>
                        </a>
                    </li><!-- End individuelles Nav -->

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ route('demandesCollective') }}">
                            <span>Collectives</span>
                        </a>
                    </li><!-- End collectives Nav -->
                    {{-- <li class="nav-item">
                        <a class="nav-link collapsed" href="#">
                            <span>Prise en charge</span>
                        </a>
                    </li> --}}
                    <!-- End Prise en charges Nav -->
                </ul>
            </li><!-- End demandes Nav -->
        @endcan
        {{--  @endif --}}
        {{-- @if (auth()->user()->hasRole('Operateur')) --}}
        @can('operateur-demande-view')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#demandeurs-operateur-nav" data-bs-toggle="collapse"
                    href="#">
                    <i class="bi bi-folder-plus"></i><span>Devenir opérateur</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="demandeurs-operateur-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ route('devenirOperateur') }}">
                            <span>Agrément</span>
                        </a>
                    </li><!-- End collectives Nav -->
                </ul>
            </li><!-- End demandes Nav -->
        @endcan
        {{-- @endif --}}

        {{-- @if (auth()->user()->hasRole('super-admin|DIOF|ADIOF|DEC')) --}}
        {{-- <li class="nav-heading">Gestion opérateurs</li> --}}
        {{-- Formations --}}
        @can('operateur-view')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#operateur-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-people-fill"></i><span>Gestion opérateurs</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="operateur-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('operateurs') }}">
                            <span>Opérateurs</span>
                        </a>
                    </li><!-- End operateurs Nav -->
                    @can('agrement-view')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ route('agrement') }}">
                                <span>Traitement agréments</span>
                            </a>
                        </li><!-- End operateurs Nav -->
                    @endcan

                    @can('agrement-commission')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ route('commissionagrements.index') }}">
                                <span>Commission agrément</span>
                            </a>
                        </li><!-- End operateurs Nav -->
                    @endcan

                    @can('agrement-module')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ url('operateurmodules') }}">
                                <span>Modules</span>
                            </a>
                        </li><!-- End operateurmodules Nav -->
                    @endcan

                </ul>
            </li><!-- End Formations Nav -->
        @endcan
        @can('formation-view')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#formations-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-folder-symlink-fill"></i><span>{{ __('Gestion formations') }}</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="formations-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('formations') }}">
                            <span>Formations</span>
                        </a>
                    </li><!-- End Formations Nav -->
                    @can('ingenieur-view')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ url('ingenieurs') }}">
                                <span>Ingénieurs</span>
                            </a>
                        </li><!-- End Formations Nav -->
                    @endcan
                    @can('evaluateur-view')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ url('evaluateurs') }}">
                                <span>Evaluateurs</span>
                            </a>
                        </li><!-- End Formations Nav -->
                    @endcan
                </ul>
            </li>
        @endcan
        {{-- <li class="nav-heading">Gestion localités</li> --}}

        @can('localite-view')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#localite-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-globe"></i><span>Gestion localités</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="localite-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('localites') }}">
                            <span>Localités</span>
                        </a>
                    </li><!-- End localites Nav -->
                    @can('region-view')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ url('regions') }}">
                                <span>Régions</span>
                            </a>
                        </li><!-- End regions Nav -->
                    @endcan

                    {{-- <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('departements') }}">
                            <span>Départements</span>
                        </a>
                    </li> --}}
                    <!-- End departements Nav -->

                    {{-- <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('arrondissements') }}">
                            <span>Arrondissement</span>
                        </a>
                    </li> --}}
                    <!-- End arrondissements Nav -->

                    {{-- <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('communes') }}">
                            <span>Commune</span>
                        </a>
                    </li> --}}
                    <!-- End communes Nav -->
                </ul>
            </li><!-- End Courriers Nav -->
        @endcan

        {{-- <li class="nav-heading">EMPLOYES</li> --}}
        {{-- @endif --}}

        {{-- @if (auth()->user()->hasRole('super-admin|DRH')) --}}
        @can('employe-view')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#employes-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-people"></i><span>Gestion employés</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="employes-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('/employes') }}">
                            {{-- <i class="bi bi-person"></i> --}}
                            <span>Employés</span>
                        </a>
                    </li><!-- End employes Page Nav -->
                    {{-- <li class="nav-heading">PARAMETRES</li> --}}
                    @can('direction-view')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ url('/directions') }}">
                                {{-- <i class="bi bi-stack"></i> --}}
                                <span>Directions</span>
                            </a>
                        </li><!-- End directions Page Nav -->
                    @endcan
                    @can('categorie-view')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ url('/categories') }}">
                                {{-- <i class="bi bi-stack"></i> --}}
                                <span>Catégories</span>
                            </a>
                        </li><!-- End categories Page Nav -->
                    @endcan
                    @can('fonction-view')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ url('/fonctions') }}">
                                {{-- <i class="bi bi-stack"></i> --}}
                                <span>Fonction</span>
                            </a>
                        </li><!-- End fonction Page Nav -->
                    @endcan
                    @can('loi-view')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ url('/lois') }}">
                                {{-- <i class="bi bi-stack"></i> --}}
                                <span>Lois</span>
                            </a>
                        </li><!-- End loi Page Nav -->
                    @endcan
                    @can('decret-view')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ url('/decrets') }}">
                                {{-- <i class="bi bi-stack"></i> --}}
                                <span>Decret</span>
                            </a>
                        </li><!-- End loi Page Nav -->
                    @endcan
                    @can('pv-recrutement-view')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ url('/procesverbals') }}">
                                {{-- <i class="bi bi-stack"></i> --}}
                                <span>PV</span>
                            </a>
                        </li><!-- End PV Page Nav -->
                    @endcan
                    @can('decision')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ url('/decisions') }}">
                                {{-- <i class="bi bi-stack"></i> --}}
                                <span>Décisions</span>
                            </a>
                        </li><!-- End Décisions Page Nav -->
                    @endcan
                    @can('article-view')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ url('/articles') }}">
                                {{-- <i class="bi bi-stack"></i> --}}
                                <span>Articles</span>
                            </a>
                        </li><!-- End nomminations Page Nav -->
                    @endcan
                    @can('nommination-view')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ url('/nomminations') }}">
                                {{-- <i class="bi bi-stack"></i> --}}
                                <span>Nomminations</span>
                            </a>
                        </li><!-- End nomminations Page Nav -->
                    @endcan

                </ul>
            </li>
        @endcan
        {{-- @endif --}}

        {{-- @if (auth()->user()->hasRole('super-admin|DIOF|ADIOF')) --}}
        @can('module-view')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#modules-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layers-half"></i><span>{{ __('Gestion modules') }}</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="modules-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('modules') }}">
                            <span>Modules</span>
                        </a>
                    </li><!-- End utilisateurs Nav -->
                    @can('domaine-view')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ url('domaines') }}">
                                <span>Domaines</span>
                            </a>
                        </li>
                    @endcan
                    @can('secteur-view')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ url('secteurs') }}">
                                <span>Secteurs</span>
                            </a>
                        </li><!-- End utilisateurs Nav -->
                    @endcan
                </ul>
            </li>
        @endcan

        @can('projet-view')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('projets') }}">
                    <i class="bi bi-layers-half"></i>
                    <span>Gestion projets</span>
                </a>
            </li><!-- End utilisateurs Nav -->
        @endcan
        {{-- @endif --}}
        {{--  @if (auth()->user()->hasRole('super-admin')) --}}
        @can('user-view')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('user') }}">
                    <i class="bi bi-person-plus"></i>
                    <span>Gestion utilisateurs</span>
                </a>
            </li><!-- End utilisateurs Nav -->
        @endcan
        {{-- <li class="nav-heading">{{ __("Contrôle d'accès") }}</li> --}}
        @can('role-view')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#autorisation-nav" data-bs-toggle="collapse"
                    href="#">
                    <i class="bi bi-key"></i><span>{{ __("Contrôle d'accès") }}</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="autorisation-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('roles') }}">
                            <span>Roles</span>
                        </a>
                    </li><!-- End roles Nav -->
                    @can('permission-view')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ url('permissions') }}">
                                <span>Permissions</span>
                            </a>
                        </li><!-- End Permissions Nav -->
                    @endcan
                </ul>
            </li><!-- End Courriers Nav -->
        @endcan
        @can('rapport-view')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#rapport-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-files"></i><span>{{ __('Rapports') }}</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="rapport-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    @can('rapport-individuelle-view')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ route('individuelles.rapport') }}">
                                <span>Demandes individuelles</span>
                            </a>
                        </li>
                    @endcan

                    @can('rapport-collective-view')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ route('collectives.rapport') }}">
                                <span>Demandes collectives</span>
                            </a>
                        </li>
                    @endcan

                    @can('rapport-individuelle-view')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ route('modules.rapport') }}">
                                <span>Demandeurs modules</span>
                            </a>
                        </li>
                    @endcan

                    @can('rapport-formation-view')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ route('formations.rapport') }}">
                                <span>Demandeurs formations</span>
                            </a>
                        </li>
                    @endcan

                    @can('rapport-arrive-view')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ route('arrives.rapport') }}">
                                <span>Courriers arrivés</span>
                            </a>
                        </li>
                    @endcan
                    @can('rapport-arrive-view')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ route('departs.rapport') }}">
                                <span>Courriers départs</span>
                            </a>
                        </li>
                    @endcan

                    @can('rapport-operateur-view')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ route('operateurs.rapport') }}">
                                <span>Opérateurs</span>
                            </a>
                        </li>
                    @endcan

                    @can('rapport-formes-view')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="#">
                                <span>Formés</span>
                            </a>
                        </li>
                    @endcan

                </ul>
            </li><!-- End Courriers Nav -->
        @endcan
        <!-- End utilisateurs Nav -->
        {{-- @endif --}}
        {{-- <li class="nav-heading">Pages</li> --}}

        {{-- <li class="nav-item">
            <a class="nav-link collapsed" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>F.A.Q</span>
            </a>
        </li> --}}
        <!-- End F.A.Q Page Nav -->

        {{-- <li class="nav-item">
            <a class="nav-link collapsed" href="pages-contact.html">
                <i class="bi bi-envelope"></i>
                <span>Contact</span>
            </a>
        </li> --}}
        <!-- End Contact Page Nav -->

        {{-- <li class="nav-item">
            <a class="nav-link collapsed" href="pages-register.html">
                <i class="bi bi-card-list"></i>
                <span>Register</span>
            </a>
        </li> --}}
        <!-- End Register Page Nav -->

        {{-- <li class="nav-item">
            <a class="nav-link collapsed" href="{{ url('/page-login') }}">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Login</span>
            </a>
        </li> --}}
        <!-- End Login Page Nav -->

        {{--  <li class="nav-item">
            <a class="nav-link collapsed" href="pages-error-404.html">
                <i class="bi bi-dash-circle"></i>
                <span>Error 404</span>
            </a>
        </li> --}}
        <!-- End Error 404 Page Nav -->

        {{-- <li class="nav-item">
            <a class="nav-link collapsed" href="pages-blank.html">
                <i class="bi bi-file-earmark"></i>
                <span>Blank</span>
            </a>
        </li> --}}
        <!-- End Blank Page Nav -->

    </ul>

</aside>
