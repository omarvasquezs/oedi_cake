<?php
/**
 * @var \App\View\AppView $this
 */
$this->assign('title', $title ?? 'Calendario de Compromisos');
?>

<div class="calendario-compromisos">
    <div style="margin-bottom: 2rem;">
        <h2 style="margin: 0 0 0.5rem 0; color: #2c3e50; font-size: 24px; font-weight: 500;">
            <i class="fa-solid fa-calendar"></i> Calendario de Compromisos
        </h2>
        <p style="margin: 0; color: #7f8c8d; font-size: 14px;">Visualiza y gestiona tus compromisos con municipalidades</p>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
        <!-- Calendar -->
        <div style="background: white; padding: 1.5rem; border-radius: 8px; border: 1px solid #e0e0e0; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
            <!-- Calendar Header -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <button style="background: transparent; border: none; color: #3498db; cursor: pointer; font-size: 14px; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-chevron-left"></i> Anterior
                </button>
                <div style="font-weight: 600; color: #2c3e50; font-size: 16px;">OCTUBRE DE 2025</div>
                <button style="background: transparent; border: none; color: #3498db; cursor: pointer; font-size: 14px; display: flex; align-items: center; gap: 0.5rem;">
                    Siguiente <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>

            <!-- Calendar Grid -->
            <table style="width: 100%; border-collapse: collapse; text-align: center;">
                <thead>
                    <tr>
                        <th style="padding: 0.75rem; font-size: 12px; color: #7f8c8d; font-weight: 600;">LUN</th>
                        <th style="padding: 0.75rem; font-size: 12px; color: #7f8c8d; font-weight: 600;">MAR</th>
                        <th style="padding: 0.75rem; font-size: 12px; color: #7f8c8d; font-weight: 600;">MIÉ</th>
                        <th style="padding: 0.75rem; font-size: 12px; color: #7f8c8d; font-weight: 600;">JUE</th>
                        <th style="padding: 0.75rem; font-size: 12px; color: #7f8c8d; font-weight: 600;">VIE</th>
                        <th style="padding: 0.75rem; font-size: 12px; color: #7f8c8d; font-weight: 600;">SÁB</th>
                        <th style="padding: 0.75rem; font-size: 12px; color: #7f8c8d; font-weight: 600;">DOM</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 0.75rem; color: #bdc3c7; font-size: 14px;">29</td>
                        <td style="padding: 0.75rem; color: #bdc3c7; font-size: 14px;">30</td>
                        <td style="padding: 0.75rem; color: #2c3e50; font-size: 14px;">1</td>
                        <td style="padding: 0.75rem; color: #2c3e50; font-size: 14px;">2</td>
                        <td style="padding: 0.75rem; color: #2c3e50; font-size: 14px;">3</td>
                        <td style="padding: 0.75rem; color: #e74c3c; font-size: 14px;">4</td>
                        <td style="padding: 0.75rem; color: #e74c3c; font-size: 14px;">5</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.75rem; color: #2c3e50; font-size: 14px;">6</td>
                        <td style="padding: 0.75rem; color: #2c3e50; font-size: 14px;">7</td>
                        <td style="padding: 0.75rem; color: #2c3e50; font-size: 14px;">8</td>
                        <td style="padding: 0.75rem; background: #3498db; color: white; font-size: 14px; border-radius: 50%; font-weight: 600; width: 40px; height: 40px;">9</td>
                        <td style="padding: 0.75rem; color: #2c3e50; font-size: 14px;">10</td>
                        <td style="padding: 0.75rem; color: #e74c3c; font-size: 14px;">11</td>
                        <td style="padding: 0.75rem; color: #e74c3c; font-size: 14px;">12</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.75rem; color: #2c3e50; font-size: 14px;">13</td>
                        <td style="padding: 0.75rem; color: #2c3e50; font-size: 14px;">14</td>
                        <td style="padding: 0.75rem; color: #2c3e50; font-size: 14px;">15</td>
                        <td style="padding: 0.75rem; color: #2c3e50; font-size: 14px;">16</td>
                        <td style="padding: 0.75rem; color: #2c3e50; font-size: 14px;">17</td>
                        <td style="padding: 0.75rem; color: #e74c3c; font-size: 14px;">18</td>
                        <td style="padding: 0.75rem; color: #e74c3c; font-size: 14px;">19</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.75rem; color: #2c3e50; font-size: 14px;">20</td>
                        <td style="padding: 0.75rem; color: #2c3e50; font-size: 14px;">21</td>
                        <td style="padding: 0.75rem; color: #2c3e50; font-size: 14px;">22</td>
                        <td style="padding: 0.75rem; color: #2c3e50; font-size: 14px;">23</td>
                        <td style="padding: 0.75rem; color: #2c3e50; font-size: 14px;">24</td>
                        <td style="padding: 0.75rem; color: #e74c3c; font-size: 14px;">25</td>
                        <td style="padding: 0.75rem; color: #e74c3c; font-size: 14px;">26</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.75rem; color: #2c3e50; font-size: 14px;">27</td>
                        <td style="padding: 0.75rem; color: #2c3e50; font-size: 14px;">28</td>
                        <td style="padding: 0.75rem; color: #2c3e50; font-size: 14px;">29</td>
                        <td style="padding: 0.75rem; color: #2c3e50; font-size: 14px;">30</td>
                        <td style="padding: 0.75rem; color: #2c3e50; font-size: 14px;">31</td>
                        <td style="padding: 0.75rem; color: #bdc3c7; font-size: 14px;">1</td>
                        <td style="padding: 0.75rem; color: #bdc3c7; font-size: 14px;">2</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Selected Date Info -->
        <div style="background: white; padding: 1.5rem; border-radius: 8px; border: 1px solid #e0e0e0; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
            <h3 style="margin: 0 0 1rem 0; color: #2c3e50; font-size: 18px; font-weight: 500;">Selecciona una fecha</h3>
            <p style="color: #95a5a6; font-size: 14px;">Haz clic en una fecha del calendario para ver los compromisos programados.</p>
        </div>
    </div>
</div>
