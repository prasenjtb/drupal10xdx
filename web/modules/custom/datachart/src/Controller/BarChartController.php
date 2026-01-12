<?php

namespace Drupal\datachart\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Render\BubbleableMetadata;
use Drupal\charts\ChartBuilderInterface;
use Drupal\Core\HtmlCommand;
use Drupal\Core\AjaxResponse;
use Drupal\Core\AppendCommand;
use Drupal\Core\ReplaceResponse;
use Drupal\Core\Url;
use Drupal\Core\Link;
use Drupal\Core\Asset\LibraryDiscoveryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * class BarChartController
*/
class BarChartController extends ControllerBase
{
  public function enquiryCountChart(Request $request)
  {

    $chart = [
      '#type' => 'chart',
      '#chart_type' => 'column',
      '#title' => 'chart counts',
      '#chart_library' => 'highcharts',
      '#data_labels' => TRUE,
      '#tooltips' => TRUE,
      '#height' => 100,
      '#height_units' => '%',
      '#weidth' => 100,
      '#width_units' => '%',
      '#attached' => [
        'library' => ['datachart/barchart_interactions'],
      ],
    ];

    $data_points = [];
    $xaxis_labels = [];

    $data_points[] = [
        'y' => '90',
        'color' => '#FFB66F',
        'custom' => ['label' => 'data label 1'],
    ];

    $data_points[] = [
        'y' => '80',
        'color' => '#0FB66F',
        'custom' => ['label' => 'data label 2'],
    ];

    $chart['data'] = [
      '#type' => 'chart_data',
      '#data' => $data_points,
    ];

    $chart['#raw_option'] = [
        'legend' => [
            'enabled' => TRUE,
            'layout' => 'vertical',
            'align' => 'right',
            'verticalAlign' => 'middle',
        ],
      'plotOptions' => [
        'series' => [
            'dataLabels' => ['enabled' => TRUE],
            'showInLegend' => FALSE,
        ],
      ],
      'tooltip' => [
        'enabled' => TRUE,
        'pointFormat' => '{point.name}: <b>{point.y}</b>',
      ],
    ]; 
    
        
    $chart['xaxis'] = [
      '#type' => 'chart_xaxis',
      '#labels' => 'x-axis label',
    ];

    $chart['yaxis'] = [
      '#type' => 'chart_xaxis',
      '#labels' => 'y-axis label',
    ];

    $totals_output = [
      '#theme' => 'item_list',
      '#title' => $this->t('Total count'),
      '#items' => [],
      '#attributes' => ['class' => ['status-totals']],  
    ];

    $totals_output['#items'][] = ['#markup' => 'runs-10'];
    $totals_output['#items'][] = ['#markup' => 'runs-20'];

    //dump($chart);
    //dump($totals_output);

    return [
      'layout_wrapper' => [
        '#type' => 'container',
        '#attributes' => ['class' => ['chart-with-totals'], 'style' => 'display: flex; gap: 20px;'],
        'chart' => $chart,
        'totals' => $totals_output,
      ],
      'table_container' => [
        '#type' => 'container',
        '#attributes' => ['id' => 'chart-table-container'],
      ],
    ];

  }


}


