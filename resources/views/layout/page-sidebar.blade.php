<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        @if (auth()->user()->hasRole('super-admin'))
            <li class="nav-item">
                <a class="nav-link " href="{{ url('/home') }}">
                    <i class="bi bi-grid"></i>
                    <span>Tableau de bord</span>
                </a>
            </li><!-- End Dashboard Nav -->
        @endif

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
        @if (auth()->user()->hasRole('super-admin'))
            {{-- <li class="nav-heading">Gestion courrier</li> --}}
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#courrier-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-envelope"></i><span>Gestion courrier</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="courrier-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('arrives') }}">
                            <span>Arrivé</span>
                        </a>
                    </li><!-- End arrives Nav -->

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('departs') }}">
                            <span>Départ</span>
                        </a>
                    </li><!-- End departs Nav -->

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#">
                            <span>Interne</span>
                        </a>
                    </li><!-- End internes Nav -->
                </ul>
            </li><!-- End Courriers Nav -->
        @endif
        {{-- <li class="nav-heading">Gestion demandeurs</li> --}}
        @if (auth()->user()->hasRole('super-admin'))
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#demande-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-folder-plus"></i><span>Gestion demandeurs</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="demande-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('individuelles') }}">
                            <span>Demandes individuelles</span>
                        </a>
                    </li><!-- End individuelles Nav -->

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('collectives') }}">
                            <span>Demandes collectives</span>
                        </a>
                    </li><!-- End collectives Nav -->

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#">
                            <span>Demandes prise en charge</span>
                        </a>
                    </li><!-- End Prise en charges Nav -->
                </ul>
            </li><!-- End demandes Nav -->
        @endif
        @if (auth()->user()->hasRole('Demandeur'))
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

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ route('devenirOperateur') }}">
                            <span>Devenir Opérateur</span>
                        </a>
                    </li><!-- End collectives Nav -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#">
                            <span>Prise en charge</span>
                        </a>
                    </li><!-- End Prise en charges Nav -->
                </ul>
            </li><!-- End demandes Nav -->
        @endif

        @if (auth()->user()->hasRole('super-admin'))
            {{-- <li class="nav-heading">Gestion opérateurs</li> --}}
            {{-- Formations --}}
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

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ route('agrement') }}">
                            <span>Validation agréments</span>
                        </a>
                    </li><!-- End operateurs Nav -->

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ route('commissionagrements.index') }}">
                            <span>Commission agrément</span>
                        </a>
                    </li><!-- End operateurs Nav -->

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('operateurmodules') }}">
                            <span>Modules</span>
                        </a>
                    </li><!-- End operateurmodules Nav -->

                </ul>
            </li><!-- End Formations Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#formations-nav" data-bs-toggle="collapse"
                    href="#">
                    <i class="bi bi-folder-symlink-fill"></i><span>{{ __('Gestion formations') }}</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="formations-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('formations') }}">
                            <span>Formations</span>
                        </a>
                    </li><!-- End Formations Nav -->

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('ingenieurs') }}">
                            <span>Ingénieurs</span>
                        </a>
                    </li><!-- End Formations Nav -->

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('evaluateurs') }}">
                            <span>Evaluateurs</span>
                        </a>
                    </li><!-- End Formations Nav -->

                </ul>
            </li>

            {{-- <li class="nav-heading">Gestion localités</li> --}}

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
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('regions') }}">
                            <span>Régions</span>
                        </a>
                    </li><!-- End regions Nav -->

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

            {{-- <li class="nav-heading">EMPLOYES</li> --}}

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#employes-nav" data-bs-toggle="collapse"
                    href="#">
                    <i class="bi bi-people"></i><span>Gestion employés</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="employes-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('/employes') }}">
                            {{-- <i class="bi bi-person"></i> --}}
                            <span>Employés</span>
                        </a>
                    </li><!-- End employes Page Nav -->
                    {{-- <li class="nav-heading">PARAMETRES</li> --}}
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('/directions') }}">
                            {{-- <i class="bi bi-stack"></i> --}}
                            <span>Directions</span>
                        </a>
                    </li><!-- End directions Page Nav -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('/categories') }}">
                            {{-- <i class="bi bi-stack"></i> --}}
                            <span>Catégories</span>
                        </a>
                    </li><!-- End categories Page Nav -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('/fonctions') }}">
                            {{-- <i class="bi bi-stack"></i> --}}
                            <span>Fonction</span>
                        </a>
                    </li><!-- End fonction Page Nav -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('/lois') }}">
                            {{-- <i class="bi bi-stack"></i> --}}
                            <span>Lois</span>
                        </a>
                    </li><!-- End loi Page Nav -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('/decrets') }}">
                            {{-- <i class="bi bi-stack"></i> --}}
                            <span>Decret</span>
                        </a>
                    </li><!-- End loi Page Nav -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('/procesverbals') }}">
                            {{-- <i class="bi bi-stack"></i> --}}
                            <span>PV</span>
                        </a>
                    </li><!-- End PV Page Nav -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('/decisions') }}">
                            {{-- <i class="bi bi-stack"></i> --}}
                            <span>Décisions</span>
                        </a>
                    </li><!-- End Décisions Page Nav -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('/articles') }}">
                            {{-- <i class="bi bi-stack"></i> --}}
                            <span>Articles</span>
                        </a>
                    </li><!-- End nomminations Page Nav -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('/nomminations') }}">
                            {{-- <i class="bi bi-stack"></i> --}}
                            <span>Nomminations</span>
                        </a>
                    </li><!-- End nomminations Page Nav -->

                </ul>
            </li>
        @endif

        @if (auth()->user()->hasRole('super-admin'))
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#modules-nav" data-bs-toggle="collapse"
                    href="#">
                    <i class="bi bi-layers-half"></i><span>{{ __('Gestion modules') }}</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="modules-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">


                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('modules') }}">
                            <span>Modules</span>
                        </a>
                    </li><!-- End utilisateurs Nav -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('domaines') }}">
                            <span>Domaines</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('secteurs') }}">
                            <span>Secteurs</span>
                        </a>
                    </li><!-- End utilisateurs Nav -->
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('projets') }}">
                    <i class="bi bi-layers-half"></i>
                    <span>Gestion projets</span>
                </a>
            </li><!-- End utilisateurs Nav -->
        @endif
        @if (auth()->user()->hasRole('super-admin'))
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('user') }}">
                    <i class="bi bi-person-plus"></i>
                    <span>Gestion utilisateurs</span>
                </a>
            </li><!-- End utilisateurs Nav -->
            {{-- <li class="nav-heading">{{ __("Contrôle d'accès") }}</li> --}}
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

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('permissions') }}">
                            <span>Permissions</span>
                        </a>
                    </li><!-- End Permissions Nav -->
                </ul>
            </li><!-- End Courriers Nav -->
            <!-- End utilisateurs Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#">
                    <i class="bi bi-files"></i>
                    <span>Rapports</span>
                </a>
            </li><!-- End utilisateurs Nav -->
        @endif
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
